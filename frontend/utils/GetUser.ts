import { useCookie } from "#app";

export const getUser = async () => {
  const config = useRuntimeConfig();
  const token = useCookie("token");

  try {
    const request = await fetch(`${config.public.apiBase}/user`, {
      headers: {
        accept: "application/json",
        contentType: "application/json",
        Authorization: `Bearer ${token.value}`,
      },
    });

    return await request.json();

  } catch (error) {
    console.error(error);
}
};
