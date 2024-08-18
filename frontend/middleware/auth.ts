import { useCookie } from "#app";

async function isAuthenticated(): Promise<boolean> {
    const token = useCookie('token');
    if (token.value === null) {
        return false
    } 

    try {
        const config = useRuntimeConfig();

        const request = await fetch(`${config.public.apiBase}/user`, {
            headers: {
                accept: 'application/json',
                contentType: 'application/json',
                Authorization: `Bearer ${token.value}`,
            },
        })
        
        if (request.status === 200) {
            return true
        }

        return false
    } catch (error) {
        return false
    }
 }
// ---cut---
export default defineNuxtRouteMiddleware(async (to, from) => {
  // isAuthenticated() is an example method verifying if a user is authenticated
  if (await isAuthenticated() === false) {
    return navigateTo('/login')
  }
})
