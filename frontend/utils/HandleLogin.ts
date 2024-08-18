import { useCookie } from '#app';

export const handleLogin = async (login : {
    email : string,
    password : string
}, toast : any) => {
    const config = useRuntimeConfig();
    const token = useCookie('token');
    const user = useCookie('user');
    const email = useCookie('email');

    try {
      const request = await fetch(`${config.public.apiBase}/user/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(login),
      });
      if (request.ok) {
        const response = await request.json();
        console.log(response.token);
        token.value = response.token;
        user.value = response.data.name;
        email.value = response.data.email;
        toast.add({ severity: 'success', summary: 'Success', detail: 'Login successful' });
        window.location.href = '/';
      }
      
    } catch (error) {
      toast.add({ severity: 'error', summary: 'Error', detail: error });
    }
  };