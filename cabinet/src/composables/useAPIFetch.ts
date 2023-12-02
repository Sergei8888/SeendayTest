import { stringify } from "qs";

type useFetchType = typeof useFetch;

// wrap useFetch with configuration needed to talk to our API
export const useAPIFetch: useFetchType = (path, options = {}) => {
  const config = useRuntimeConfig();

  options.server = false;

  if (import.meta.env.MODE && config.public.devToken) {
    options.query = {
      dev_token: config.public.devToken,
      ...options.query
    };
  }

  const { query, ...optionsWithoutQuery } = options;

  const pathWidthQuery = query ? `${path}?${stringify(query)}` : path;

  return useFetch(pathWidthQuery, optionsWithoutQuery);
};
