import { useConfirm } from 'primevue/useconfirm';

interface ConfirmProps {
    title?: string;
    message?: string;
    confirm?: string;
    cancel?: string;
    confirmSeverity?: string;
    icon?: string;
}

export function useDialogs() {
    const PrimeVueConfirm = useConfirm();

    function confirm(options?: ConfirmProps): Promise<boolean> {
        return new Promise((resolve) => {
            PrimeVueConfirm.require({
                message: options?.message || 'Sei sicuro?',
                header: options?.title || 'Conferma',
                icon: options?.icon || 'pi pi-info-circle',
                rejectProps: {
                    label: options?.cancel || 'Annulla',
                    severity: 'secondary',
                    variant: 'text',
                },
                acceptProps: {
                    label: options?.confirm || 'Conferma',
                    severity: options?.confirmSeverity,
                },
                accept: () => {
                    resolve(true);
                },
                reject: () => {
                    resolve(false);
                },
            });
        });
    }

    function confirmDelete(): Promise<boolean> {
        return confirm({
            message:
                "Una volta eliminato l'elemento, tutte le sue risorse e dati verranno eliminati in modo permanente.",
            confirm: 'Elimina',
            title: 'Sei sicuro di voler eliminare questo elemento?',
            confirmSeverity: 'danger',
            icon: 'pi pi-exclamation-triangle',
        });
    }

    return { confirm, confirmDelete };
}
