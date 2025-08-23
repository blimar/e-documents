<?php

namespace App\Http\Controllers;

use App\Models\LaporanMutasi;
use App\Models\MKelompok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class DocController extends Controller
{
    public function laporanMutasi(Request $request, string $tanggal, string $status, string $kelompok)
    {

        $template_path = public_path("templates/laporan_mutasi.docx");
        $template = new TemplateProcessor($template_path);

        // Header
        $kelompok = MKelompok::with(['personel.pangkat', 'personel.jabatan'])
            ->find($kelompok);

        $template->setValue("kelompok", $kelompok->nama);
        $template->setValue("date", Carbon::parse($tanggal)->translatedFormat('d F Y'));
        if ($status === "malam") {
            $template->setValue("time", "20:00 s/d 05:00");
        } else {
            $template->setValue("time", "08:00 s/d 20:00");
        }

        // Footer
        $template->setValue("nama_petugas_baru", "Petugas baru");
        $template->setValue("pangkat_petugas_baru", "Beginner");
        $template->setValue("nrp_petugas_baru", "01234567");

        $template->setValue("nama_petugas_lama", "Petugas lama");
        $template->setValue("pangkat_petugas_lama", "Intermediete");
        $template->setValue("nrp_petugas_lama", "7654321");

        $template->setValue("nama_pimpinan", "Petugas pimpinan");
        $template->setValue("pangkat_pimpinan", "Leader");
        $template->setValue("nrp_pimpinan", "9876542");

        $template->setValue("today", Carbon::parse($tanggal)->translatedFormat('d F Y'));

        $personel = [];

        foreach ($kelompok->personel as $index => $data) {
            $personel[] = [
                'np' => $index + 1,
                'name_p' => $data->nama,
                'pangkat_p' => $data->pangkat->nama,
                'nrp_p' => $data->nrp,
                'jabatan_p' => $data->jabatan->nama,
                'ket_p' => 'Hadir'
            ];
        }

        $carbonDate = Carbon::parse($tanggal);

        if ($status === 'siang') {
            $start = $carbonDate->copy()->setTime(8, 0, 0);
            $end = $carbonDate->copy()->setTime(20, 0, 0);
        } else {
            $start = $carbonDate->copy()->setTime(20, 0, 0);
            $end = $carbonDate->copy()->addDay()->setTime(5, 0, 0);
        }

        $mutasi = LaporanMutasi::whereBetween('created_at', [$start, $end])->get()->toArray();
        $format_mutasi = [];

        foreach ($mutasi as $index => $m) {
            $mutasi = [
                'nm' => $index + 1,
                'time_m' => Carbon::parse($m['created_at'])->format('H:i'),
                'description_m' => $m['deskripsi'],
                'ket_m' => $m['ket_m'] ?? '-'
            ];

            $format_mutasi[] = $mutasi;
        }

        if (!empty($personel)) {
            $template->cloneRowAndSetValues("np", $personel);
        } else {
            $template->setValue("np", "");
            $template->setValue("name_p", "");
            $template->setValue("pangkat_p", "");
            $template->setValue("nrp_p", "");
            $template->setValue("jabatan_p", "");
            $template->setValue("ket_p", "");
        }

        if (!empty($format_mutasi)) {
            $template->cloneRowAndSetValues("nm", $format_mutasi);
        } else {
            $template->setValue("nm", "");
            $template->setValue("time_m", "");
            $template->setValue("description_m", "");
            $template->setValue("ket_m", "");
        }

        // $template->cloneRowAndSetValues("np", $personel);
        // $template->cloneRowAndSetValues("nm", $format_mutasi);

        $output_path = storage_path("app/laporan_mutasi.docx");
        $template->saveAs($output_path);

        return response()->download($output_path)->deleteFileAfterSend();
    }
}
