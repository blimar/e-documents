import DashboardLayout from '@/layouts/dashboard-layout';
import { Jabatan } from '@/types';
import { Head } from '@inertiajs/react';
import { columns } from './columns';
import { DataTable } from './data-table';

interface Props {
  jabatans: Jabatan[];
}

export default function HalamanJabatan({ jabatans }: Props) {
  return (
    <>
      <Head title="Jabatan" />
      <DashboardLayout>
        <div>
          <h1 className="text-2xl, font-bold, tracking-tight">Halaman Jabatan</h1>
          <p className="text-muted-foreground">List Jabatan</p>
          <div className="mt-5">
            <DataTable columns={columns} data={jabatans} />
          </div>
        </div>
      </DashboardLayout>
    </>
  );
}
