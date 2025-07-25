export interface Kelompok {
    id: string;
    nama: string;
    created_at: Date;
    updated_at: Date;
}

export interface Pangkat{
    id: string;
    nama: string;
    created_at: Date;
    updated_at: Date;
}

export interface Jabatan {
    id: string;
    nama: string;
    created_at: Date;
    updated_at: Date;
}

export interface Personel{
    id: string;
    m_jabatan_id: string;
    m_pangkat_id: string;
    m_kelompok_id: string;
    nama: string;
    nrp: string;
    created_at: Date;
    updated_at: Date;
}