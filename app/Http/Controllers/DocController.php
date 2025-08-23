<?php

namespace App\Http\Controllers;

use App\Models\LaporanMutasi;
use App\Models\MKelompok;
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
        $template->setValue("date", "20 Mei 2025");
        $template->setValue("time", "20:00 s/d 05:000");

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

        $template->setValue("today", "20 Januari 2025");

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

        // $personel = [
        //     [
        //         'np' => 1,
        //         'name_p' => "Anang",
        //         'pangkat_p' => "Beginner",
        //         'nrp_p' => "123456",
        //         'jabatan_p' => "Owner",
        //         'ket_p' => "Hadir"
        //     ],
        //     [
        //         'np' => 2,
        //         'name_p' => "Anang 2",
        //         'pangkat_p' => "Beginner",
        //         'nrp_p' => "123456",
        //         'jabatan_p' => "Owner",
        //         'ket_p' => "Hadir"
        //     ],
        //     [
        //         'np' => 3,
        //         'name_p' => "Anang 3",
        //         'pangkat_p' => "Beginner",
        //         'nrp_p' => "123456",
        //         'jabatan_p' => "Owner",
        //         'ket_p' => "Hadir"
        //     ],
        //     [
        //         'np' => 4,
        //         'name_p' => "Anang 4",
        //         'pangkat_p' => "Beginner",
        //         'nrp_p' => "123456",
        //         'jabatan_p' => "Owner",
        //         'ket_p' => "Hadir"
        //     ],
        // ];

        // $format_mutasi = [
        //     [
        //         'nm' => 1,
        //         'time_m' => "08:00",
        //         "description_m" => "Pembuatan surat kehilangan 1",
        //         "ket_m" => '-'
        //     ],
        //     [
        //         'nm' => 2,
        //         'time_m' => "09:00",
        //         "description_m" => "Pembuatan surat kehilangan 2",
        //         "ket_m" => '-'
        //     ],
        //     [
        //         'nm' => 3,
        //         'time_m' => "10:00",
        //         "description_m" => "Pembuatan surat kehilangan 3",
        //         "ket_m" => '-'
        //     ]
        // ];

        $mutasi = LaporanMutasi::get()->toArray();
        $format_mutasi = [];

        foreach ($mutasi as $index => $m) {
            $mutasi = [
                'nm' => $index + 1,
                'time_m' => \Carbon\Carbon::parse($m['created_at'])->format('H:i'),
                'description_m' => $m['deskripsi'],
                'ket_m' => $m['ket_m'] ?? '-'
            ];

            $format_mutasi[] = $mutasi;
        }

        $template->cloneRowAndSetValues("np", $personel);
        $template->cloneRowAndSetValues("nm", $format_mutasi);

        $output_path = storage_path("app/laporan_mutasi.docx");
        $template->saveAs($output_path);

        return response()->download($output_path)->deleteFileAfterSend();
    }
}
