import DashboardLayout from '@/layouts/dashboard-layout';
import { Pangkat } from '@/types';
import { Head } from '@inertiajs/react';
import { columns } from './columns';
import { DataTable } from './data-table';

interface Props {
  pangkats: Pangkat[];
}

export default function HalamanPangkat({ pangkats }: Props) {
  return (
    <>
      <Head title="Pangkat" />
      <DashboardLayout>
        <div>
          <h1 className="text-2xl font-bold tracking-tight">Halaman Pangkat</h1>
          <p className="text-muted-foreground">List Data Pangkat</p>
          <div className="mt-5">
            <DataTable columns={columns} data={pangkats} />
          </div>
        </div>
      </DashboardLayout>
    </>
  );
}
