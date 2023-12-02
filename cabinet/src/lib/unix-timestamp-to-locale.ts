export const unixTimestampToLocale = (timestamp: number, options?: Intl.DateTimeFormatOptions) => {
  return new Date(timestamp * 1000).toLocaleString("ru-RU", options);
};
