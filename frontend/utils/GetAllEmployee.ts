import type { EmployeeTableType } from "~/model/EmployeeModel";

export const getAllEmployee = async (toast: any) : Promise<EmployeeTableType[]> => {
  const config = useRuntimeConfig();

  try {
    const response = await fetch(config.public.apiBase + "/employee");
    const result = await response.json();
    return result.data;
  } catch (error) {
    return toast.add({ severity: "error", summary: "Error", detail: error });
  }
};
