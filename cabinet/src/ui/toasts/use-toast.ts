import { useToastStore } from "./store-toast";

export const useToast = () => {
  const toastsStore = useToastStore();

  return {
    addToast: toastsStore.addToast,
    clearToasts: toastsStore.clearToasts
  };
};
