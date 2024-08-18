import type { Employee } from "~/model/EmployeeModel";

export const handleSubmitForm = async  (
  employee: Employee,
  toast: any,
) => {
  const config = useRuntimeConfig();

  // Check if all fields are filled
  for (const key in employee) {
    if (key === "") {
      return toast.add({
        severity: "error",
        summary: "Error",
        detail: "Please fill all fields",
        life: 3000,
      });
    }
  }

  try {
    // Format birthdate to ISO string
    employee.birthdate = employee.birthdate
      ? new Date(employee.birthdate).toISOString().split("T")[0]
      : "";


    // Send POST request to API
    const request = await fetch(`${config.public.apiBase}/employee`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(employee),
    });

    // Handle response
    if (request.status === 200) {
      toast.add({
        severity: "success",
        summary: "Success",
        detail: "Add Employee Success",
        life: 1000,
      });
      setTimeout(() => location.reload(), 1200);
    } else {
      throw new Error(`Failed to add employee: ${request.statusText}`);
    }
  } catch (error) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: error,
      life: 3000,
    });
    console.error(error);
  }
};
