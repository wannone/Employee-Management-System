import type { Employee } from "~/model/EmployeeModel";

export const handleUpdateForm = async (
    employee: Employee,
    toast: any
) => {
    const config = useRuntimeConfig();
    for (const key in employee) {
        if (key === "") {
            return toast.add({
                severity: "error",
                summary: "Error",
                detail: "There is empty fields",
                life: 3000,
            });
        }
    }
    try {
        employee.birthdate = employee.birthdate
            ? new Date(employee.birthdate).toISOString().split("T")[0]
            : "";
        const request = await fetch(`${config.public.apiBase}/employee/${employee.nip}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(employee),
        });
        if (request.status === 200) {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Update Employee Success",
                life: 1000,
            });
            setTimeout(() => location.reload(), 1200);
        } else {
            throw new Error(`Failed to update employee: ${request.statusText}`);
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
}