const breakpointEnum = {
  sm: 375,
  md: 578,
  xslg: 769,
  lg: 992,
  xl: 1200,
  xl2: 1440,
  xxl: 1600
};

type TypesEnum = keyof typeof breakpointEnum;

const breakpoints = useBreakpoints({ ...breakpointEnum });

export const useBreakpointMatcher = (breakpoint: TypesEnum) => {
  return breakpoints.greaterOrEqual(breakpoint);
};
