import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import DashboardLayout from '@/layouts/dashboard-layout';
import { Kelompok } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { Label } from '@radix-ui/react-dropdown-menu';

interface Props {
  kelompok?: Kelompok;
}

export default function FormKelompok({ kelompok }: Props) {
  const { data, setData, post, errors, processing, put } = useForm<{
    nama: string;
  }>({
    nama: kelompok ? kelompok.nama : '',
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (kelompok) {
      put(route('kelompok.update', [kelompok.id]));
    } else {
      post(route('kelompok.store'));
    }
  };
  return (
    <>
      <Head title="Form Kelompok" />
      <DashboardLayout>
        <div>
          <h2 className="text-2xl font-bold tracking-tight">Kelompok</h2>
          <p className="text-muted-foreground">Form Kelompok</p>

          <form onSubmit={handleSubmit}>
            <div className="my-5">
              <Label>Nama Kelompok</Label>
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
