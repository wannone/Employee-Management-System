export const handleDownload = async (toast: any) => {
    const config = useRuntimeConfig();

    const request = await fetch(`${config.public.apiBase}/employee/download`);

    if (request.status !== 200) {
        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: 'Something went wrong',
        });
        return;
    }
    
}