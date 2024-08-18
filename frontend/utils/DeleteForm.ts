export const handleDeleteForm = async (
    nip: string,
    toast: any
) => {
    const config = useRuntimeConfig();
    try{
        const request = await fetch(`${config.public.apiBase}/employee/${nip}`,
        {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
        }
        )
        if (request.status == 200) {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Delete Employee Success",
                life: 1000,
              });        
            }
        setTimeout(() => window.location.href = '/show', 1200);
    } catch (error) {
        return toast.add({
            severity: "error",
            summary: "Error",
            detail: error,
            life: 3000,
            });
    }
}