export type Employee = {
  nip: string;
  name: string;
  birthplace: string;
  birthdate: string;
  address: string;
  gender: string;
  group: number;
  eselon: number | null;
  position: string;
  workplace: number;
  religion: number;
  unit: number;
  phone: string;
  npwp: string;
  image_url: string | null;
};

export type EmployeeTableType = {
  nip: string;
  name: string;
  birthplace: string;
  birthdate: string;
  address: string;
  gender: string;
  group: string;
  eselon: string | null;
  position: string;
  workplace: string;
  religion: string;
  unit: string;
  phone: string;
  npwp: string;
};
