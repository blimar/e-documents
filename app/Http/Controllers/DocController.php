<?php

namespace App\Http\Controllers;

use App\Models\LaporanGangguan;
use App\Models\LaporanKehilangan;
use App\Models\LaporanMutasi;
use App\Models\LaporanPolisi;
use App\Models\MKelompok;
use App\Models\MPersonel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\Table;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Support\Facades\Response;

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
        } else if ($status === "harian") {
            $template->setValue('time', "08.00 WITA S.D. 08.00 WITA");
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

        $mutasi = null;

        if ($status === "harian") {
            $mutasi = LaporanMutasi::whereDate('created_at', $tanggal)->get()->toArray();
        } else {
            $mutasi = LaporanMutasi::whereBetween('created_at', [$start, $end])->get()->toArray();
        }

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

    public function laporanHarian(Request $request, string $tanggal) {

    }

    public function generate(Request $request)
    {
        $lp_no = $request->lp_no;
        $kelompok_id = $request->kelompok_id;
        $tanggal = $request->tanggal;
        $personel_id = $request->personel_id;

        $kelompok = MKelompok::find($kelompok_id);
        $personel = MPersonel::find($personel_id);

        $laporan_polisi = LaporanPolisi::whereDate('created_at', $tanggal)
            ->get();

        $templatePath = storage_path('app/templates/laporan-harian.docx');
        $template = new TemplateProcessor($templatePath);

        $laporan_polisi = LaporanPolisi::whereDate('created_at', $tanggal)->get();

        $laporanList = $laporan_polisi->map(function ($item) {
            return [
                'lp_no'          => $item->lp_no,
                'tindak_pidana'  => $item->pasal,
                'waktu_kejadian' => $item->waktu_kejadian,
                'tempate_kejadian' => $item->tempat_kejadian,
                'korban'         => $item->korban,
                'terlapor'       => $item->terlapor,
                'saksi'          => $item->saksi,
                'uraian'         => $item->uraian_kejadian,
                'sttlp'          => $item->satker,

                // Label
                'lp_no_label'          => "1. NO LP",
                'tindak_pidana_label'  => "2. TINDAK PIDANA",
                'waktu_kejadian_label' => "3. WAKTU KEJADIAN",
                'tempate_kejadian_label' => "4. TEMPAT KEJADIAN",
                'korban_label'         => "5. KORBAN",
                'terlapor_label'       => "6. TERLAPOR",
                'saksi_label'          => "7. SAKSI",
                'uraian_label'         => "8. URAIAN",
                'sttlp_label'          => "9. STTLP",
            ];
        })->toArray();


        $template->cloneBlock('block_laporan', count($laporanList), true, false, $laporanList);
        $template->setValue("kelompok", $kelompok->nama);

        $pengaduan = LaporanGangguan::whereDate('created_at', $tanggal)->pluck('lp_no')
            ->toArray();


        $pengaduanTeams = array_fill(0, count($pengaduan), 'Ditsiber');

        $pengaduanText = implode('<w:br/>', $pengaduan);
        $pengaduanTeamsText = implode('<w:br/>', $pengaduanTeams);

        $template->setValue("pengaduan_label", "Pengaduan");
        $template->setValue('pengaduan_items',$pengaduanText);
        $template->setValue('pengaduan_team',$pengaduanTeamsText);

        $kehilangan = LaporanKehilangan::whereDate('created_at', $tanggal)
            ->pluck('no')
            ->toArray();

        $count = count($kehilangan);

        $jumlahStatus = (int) ceil($count / 2);

        $kehilangan_status = array_fill(0, $jumlahStatus, 'Diproses');

        $kehilanganStatusText = implode('<w:br/>', $kehilangan_status);

        $kehilangan1 = [];
        $kehilangan2 = [];

        foreach ($kehilangan as $i => $item) {
            if (($i + 1) % 2 === 1) {
                // Index ganjil (karena array 0-based → +1 dulu)
                $kehilangan1[] = $item;
            } else {
                // Index genap
                $kehilangan2[] = $item;
            }
        }

        $kehilangan1Text = !empty($kehilangan1) ? implode('<w:br/>', $kehilangan1) : '';
        $kehilangan2Text = !empty($kehilangan2) ? implode('<w:br/>', $kehilangan2) : '';


        $template->setValue('kehilangan_1', $kehilangan1Text);
        $template->setValue('kehilangan_2', $kehilangan2Text);
        $template->setValue("kehilangan_status", $kehilanganStatusText);

        $carbon = Carbon::now();
        $tanggalOnly = $carbon->format('d');
        $bulanTahun = $carbon->format('m-Y');
        $bulanTahun = $carbon->translatedFormat('F Y');
        $tanggalBulanTahun = $carbon->translatedFormat('d F Y');
        $hari = $carbon->translatedFormat('l');

        $template->setValue("tanggal", $tanggalOnly);
        $template->setValue("date", $bulanTahun);
        $template->setValue("today", $tanggalBulanTahun);
        $template->setValue("waktu", $tanggalBulanTahun);
        $template->setValue("hari", $hari);

        $template->setValue('ketua_kelompok', $kelompok->nama);
        $template->setValue('nama_ketua_kelompok', $personel->nama);
        $template->setValue('jabatan_ketua_kelompok', $personel->jabatan->nama);
        $template->setValue("nrp_ketua_kelompok", $personel->nrp);
        $template->setValue("no_lp_harian", $lp_no);

        // Simpan hasil
        $fileName = $tanggal. '-laporan-harian.docx';
        $savePath = storage_path("app/public/{$fileName}");
        $template->saveAs($savePath);

        return response()->download($savePath)->deleteFileAfterSend(true);
    }
}
