import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import DashboardLayout from '@/layouts/dashboard-layout';
import { Pangkat } from '@/types';
import { useForm } from '@inertiajs/react';
import { Label } from '@radix-ui/react-dropdown-menu';
import React from 'react';

interface Props {
  pangkat?: Pangkat;
}

export default function FormPangkat({ pangkat }: Props) {
  const { data, setData, post, errors, processing, put } = useForm<{
    nama: string;
  }>({
    nama: pangkat ? pangkat.nama : '',
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (pangkat) {
      put(route('pangkat.update', [pangkat.id]));
    } else {
      post(route('pangkat.store'));
    }
  };
  return (
    <>
      <DashboardLayout>
        <div>
          <h1 className="text-2xl font-bold tracking-tight">Pangkat</h1>
          <p className="text-muted-foreground">Form Pangkat</p>

          <form onSubmit={handleSubmit}>
            <div className="my-5">
              <Label>Nama Pangkat</Label>
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
