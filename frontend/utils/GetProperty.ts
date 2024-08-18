export const getProperty = async () => {
    try {
        const config = useRuntimeConfig();
        const response = await fetch(config.public.apiBase + "/property"); // Replace with your actual API URL
        const result = await response.json();   

        return result;
    } catch (error) {
        console.log(error)
    }
}