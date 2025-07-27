import DashboardLayout from '@/layouts/dashboard-layout';
import { Kelompok } from '@/types';
import { Head } from '@inertiajs/react';
import { columns } from './columns';
import { DataTable } from './data-table';

interface Props {
  kelompoks: Kelompok[];
}

export default function HalamanKelompok({ kelompoks }: Props) {
  return (
    <>
      <Head title="Kelompok" />
      <DashboardLayout>
        <div>
          <h1 className="text-2xl font-bold tracking-tight">Halaman Kelompok</h1>
          <p className="text-muted-foreground">List Kelompok</p>
          <div className="mt-5">
            <DataTable columns={columns} data={kelompoks} />
          </div>
        </div>
      </DashboardLayout>
    </>
  );
}
