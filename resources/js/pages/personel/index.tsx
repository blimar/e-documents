import DashboardLayout from '@/layouts/dashboard-layout';
import { Kelompok, Personel } from '@/types';
import { columns } from './columns';
import { DataTable } from './data-table';

interface Props {
  kelompok: Kelompok;
  personels: Personel;
}

export default function HalamanPersonel({ kelompok, personels }: Props) {
  return (
    <>
      <DashboardLayout>
        <div>
          <h1 className="text-2xl font-bold tracking-tight">Halaman Personel {kelompok.nama}</h1>
          <p className="text-muted-foreground">List Data Personel {kelompok.nama}</p>
          <div className="my-5">
            <DataTable kelompokId={kelompok.id} columns={columns} data={personels} />
          </div>
        </div>
      </DashboardLayout>
    </>
  );
}
