import { useCookie } from "#app";

export const handleLogout = async (toast : any) => {
    const config = useRuntimeConfig();
    const token = useCookie('token');
    
    try {
        const request = await fetch(`${config.public.apiBase}/user/logout`, 
            {
                method: 'POST',
                headers: {
                    accept: 'application/json',
                    contentType: 'application/json',
                    Authorization: `Bearer ${token.value}`,
                },
            }
        );

        if (request.ok) {
            token.value = null;
        window.location.href = '/login';
        }
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Error', detail: error });
    }
  }