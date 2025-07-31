import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import DashboardLayout from '@/layouts/dashboard-layout';
import { Jabatan } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { Label } from '@radix-ui/react-dropdown-menu';

interface Props {
  jabatan?: Jabatan;
}

export default function FormJabatan({ jabatan }: Props) {
  const { data, setData, post, errors, processing, put } = useForm<{
    nama: string;
  }>({
    nama: jabatan ? jabatan.nama : '',
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (jabatan) {
      put(route('jabatan.update', [jabatan.id]));
    } else {
      post(route('jabatan.store'));
    }
  };

  return (
    <>
      <Head title="Form Jabatan" />
      <DashboardLayout>
        <div>
          <h2 className="text-2xl font-bold tracking-tight">Jabatan</h2>
          <p className="text-muted-foreground">Form Jabatan</p>

          <form onSubmit={handleSubmit}>
            <div className="my-5">
              <Label>Nama Jabatan</Label>
              <Input name="nama" value={data.nama} onChange={(e) => setData('nama', e.target.value)} />
              {errors.nama && <p className="text-red-500">{errors.nama}</p>}
            </div>
            <Button disabled={processing}>Submit</Button>
          </form>
        </div>
      </DashboardLayout>
    </>
  );
}
