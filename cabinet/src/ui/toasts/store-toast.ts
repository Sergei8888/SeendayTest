import { nanoid } from "nanoid";

import { type Toast } from "./types";

export const useToastStore = defineStore("toast", () => {
  const toasts: Ref<Toast[]> = ref([]);

  const addToast = (toast: Omit<Toast, "id">) => {
    toasts.value.push({ ...toast, id: nanoid() });
  };

  const clearToasts = () => {
    toasts.value = [];
  };

  return { toasts, addToast, clearToasts };
});
