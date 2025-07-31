import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import DashboardLayout from '@/layouts/dashboard-layout';
import { Jabatan, Kelompok, Pangkat, Personel } from '@/types';
import { useForm } from '@inertiajs/react';
import { Label } from '@radix-ui/react-dropdown-menu';
import React from 'react';

import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';

interface Props {
  kelompok: Kelompok;
  personel?: Personel;
  pangkats: Pangkat[];
  jabatans: Jabatan[];
}

export default function FormPersonel({ personel, kelompok, jabatans, pangkats }: Props) {
  const { data, setData, post, processing, errors, put } = useForm<{
    nama: string;
    m_kelompok_id: string;
    m_pangkat_id: string;
    nrp: string;
    m_jabatan_id: string;
  }>({
    nama: personel ? personel.nama : '',
    m_kelompok_id: kelompok.id,
    m_pangkat_id: personel ? personel.m_pangkat_id : '',
    nrp: personel ? personel.nrp : '',
    m_jabatan_id: personel ? personel.m_jabatan_id : '',
  });

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (personel) {
      put(route('kelompok.personel.update', [kelompok.id, personel.id]));
    } else {
      post(route('kelompok.personel.store', [kelompok.id]));
    }
  };

  return (
    <>
      <DashboardLayout>
        <div>
          <div>
            <h1 className="text-2xl font-bold tracking-tight">Personel</h1>
            <p className="text-muted-foreground">Form Personel</p>
          </div>
          <div className="my-5">
            <form onSubmit={handleSubmit} className="space-y-3">
              <div>
                <Label>Nama Personel</Label>
                <Input name="nama" value={data.nama} onChange={(e) => setData('nama', e.target.value)} />
                {errors.nama && <p className="text-sm text-red-500">{errors.nama}</p>}
              </div>
              <div>
                <Label>Pangkat</Label>
                <Select required value={data.m_pangkat_id} onValueChange={(e) => setData('m_pangkat_id', e)}>
                  <SelectTrigger className="w-[180px]">
                    <SelectValue placeholder="Pilih pangkat" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectLabel>Kategori</SelectLabel>
                      {pangkats.map((pangkat) => (
                        <SelectItem key={pangkat.id} value={pangkat.id}>
                          {pangkat.nama}
                        </SelectItem>
                      ))}
                    </SelectGroup>
                  </SelectContent>
                </Select>
                {errors.m_pangkat_id && <p className="text-red-500">{errors.m_pangkat_id}</p>}
              </div>
              <div>
                <Label>NRP</Label>
                <Input name="nrp" value={data.nrp} onChange={(e) => setData('nrp', e.target.value)} />
              </div>
              <div>
                <Label>Jabatan</Label>
                <Select required value={data.m_jabatan_id} onValueChange={(e) => setData('m_jabatan_id', e)}>
                  <SelectTrigger className="w-[180px]">
                    <SelectValue placeholder="Pilih jabatan" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectLabel>Kategori</SelectLabel>
                      {jabatans.map((jabatan) => (
                        <SelectItem key={jabatan.id} value={jabatan.id}>
                          {jabatan.nama}
                        </SelectItem>
                      ))}
                    </SelectGroup>
                  </SelectContent>
                </Select>
                {errors.m_jabatan_id && <p className="text-red-500">{errors.m_jabatan_id}</p>}
              </div>
              <Button disabled={processing}>Submit</Button>
            </form>
          </div>
        </div>
      </DashboardLayout>
    </>
  );
}
