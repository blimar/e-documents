'use client';

import { Personel } from '@/types';
import { ColumnDef } from '@tanstack/react-table';

// This type is used to define the shape of our data.
// You can use a Zod schema here if you want.

export const columns: ColumnDef<Personel>[] = [
  {
    accessorKey: 'nama',
    header: 'Nama Personel',
  },
  {
    accessorKey: 'm_pangkat_id',
    header: 'Pangkat',
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
