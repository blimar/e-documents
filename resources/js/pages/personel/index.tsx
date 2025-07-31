import DashboardLayout from '@/layouts/dashboard-layout';
import { Personel } from '@/types';
import { columns } from './columns';
import { DataTable } from './data-table';

interface Props {
  personels: Personel[];
}

export default function HalamanPersonel({ personels }: Props) {
  return (
    <>
      <DashboardLayout>
        <div>
          <h1 className='text-2xl font-bold tracking-tight'>Halaman Personel</h1>
          <p className='text-muted-foreground'>List Data Personel</p>
          <div className='my-5'>
            <DataTable columns={columns} data={personels} />
          </div>
        </div>
      </DashboardLayout>
    </>
  );
}
