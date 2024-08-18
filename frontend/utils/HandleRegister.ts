export const handleRegister = async (register : {
    name : string,
    email : string,
    password : string,
    password_confirmation : string
}, toast : any) => {
    const config = useRuntimeConfig();

    try {
        const request = await fetch(`${config.public.apiBase}/user/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(register),
        });
        if (request.ok) {
            toast.add({ severity: 'success', summary: 'Success', detail: 'Register successful' });
            window.location.href = '/login';
        }
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Error', detail: error });
    }
};