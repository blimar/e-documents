'use client';

import { Pangkat, Personel } from '@/types';
import { ColumnDef } from '@tanstack/react-table';

// This type is used to define the shape of our data.
// You can use a Zod schema here if you want.

export const columns: ColumnDef<
  Personel & {
    pangkat: Pangkat;
  }
>[] = [
  {
    accessorKey: 'nama',
    header: 'Nama Personel',
  },
  {
    // accessorKey: 'm_pangkat_id',
    id: 'pangkat',
    header: 'Pangkat',
    cell: ({ row }) => {
      const personel = row.original;
      console.log(personel);

      return personel.pangkat.nama;
    },
  },
  {
    accessorKey: 'nrp',
    header: 'NRP',
  },
  {
    accessorKey: 'm_jabatan_id',
    header: 'Jabatan',
  },
  {
    accessorKey: 'created_at',
    header: 'Created At',
  },
];
