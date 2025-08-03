<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class DocController extends Controller
{
    public function laporanMutasi(Request $request)
    {
        $template_path = public_path("templates/laporan_mutasi.docx");
        $template = new TemplateProcessor($template_path);

        // Header
        $template->setValue("kelompok", "Siaga III");
        $template->setValue("date", "20 Mei 2025");
        $template->setValue("time", "20:00 s/d 05:000");

        // Footer
        $template->setValue("nama_petugas_baru", "Petugas baru");
        $template->setValue("pangkat_petugas_baru", "Beginner");
        $template->setValue("nrp_petugas_baru", "01234567");

        $template->setValue("nama_petugas_lama", "Petugas lama");
        $template->setValue("pangkat_petugas_lama", "Intermediete");
        $template->setValue("nrp_petugas_lama", "7654321");

        $template->setValue("nama_petugas_pimpinan", "Petugas pimpinan");
        $template->setValue("pangkat_petugas_pimpinan", "Leader");
        $template->setValue("nrp_petugas_pimpinan", "9876542");
    }
}
