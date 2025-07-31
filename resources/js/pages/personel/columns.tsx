'use client';

import { Jabatan, Pangkat, Personel } from '@/types';
import { ColumnDef } from '@tanstack/react-table';
import { MoreHorizontal } from 'lucide-react';

import { Button } from '@/components/ui/button';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Link, router } from '@inertiajs/react';

// This type is used to define the shape of our data.
// You can use a Zod schema here if you want.

export const columns: ColumnDef<
  Personel & {
    pangkat: Pangkat;
    jabatan: Jabatan;
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
    // accessorKey: 'm_jabatan_id',
    id: 'jabatan',
    header: 'Jabatan',
    cell: ({ row }) => {
      const personel = row.original;

      return personel.jabatan.nama;
    },
  },
  {
    accessorKey: 'created_at',
    header: 'Created At',
  },
  {
    id: 'actions',
    cell: ({ row }) => {
      const personel = row.original;

      const handleDelete = () => {
        router.delete(route('kelompok.personel.destroy', [personel.m_kelompok_id, personel.id]));
      };

      return (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>Actions</DropdownMenuLabel>
            <DropdownMenuItem asChild>
              <Link href={route('kelompok.personel.edit', [personel.m_kelompok_id, personel.id])}>Edit</Link>
            </DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem onClick={handleDelete} variant="destructive">
              Delete
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      );
    },
  },
];
