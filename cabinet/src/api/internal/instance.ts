const config = useRuntimeConfig();

type SearchParameters = Record<string, any>;

const query: SearchParameters = {};

if (import.meta.env.DEV && config.public.devToken) {
  query.dev_token = config.public.devToken;
}

export const internalAPIFetch = $fetch.create({ query });
