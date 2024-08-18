export const uploadImage = async (nip: string, formData : FormData, toast : any) => {
    try {
        const config = useRuntimeConfig()
        await fetch(
            config.public.apiBase + "/employee/" + nip,
            {
              method: "POST",
              body: formData,
            }
          );

        toast.add({
            severity: "info",
            summary: "Success",
            detail: "File Uploaded",
            life: 1000,
          });
        return setTimeout(() => {
            window.location.reload();
          }, 1200);
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Error', detail: error });
    }
}