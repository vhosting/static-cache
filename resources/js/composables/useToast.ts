import { toast } from 'vue-toastflow';

export function useToast() {
    function success(message: string) {
        toast.success({
            title: 'Fatto',
            description: message,
        });
    }

    function error(message: string) {
        toast.error({
            title: 'Errore',
            description: message,
        });
    }

    function warning(message: string) {
        toast.warning({
            title: 'Attenzione',
            description: message,
        });
    }

    return { success, error, warning };
}
