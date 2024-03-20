export const ColorStatusRequestFile: { [key: string]: string } = {
    requerido: "primary",
    proceso: "secondary",
    finalizado: "default",
};

export const CustomResponseType = {
    JSON: "json",
    TEXT: "text",
    BLOB: "blob",
} as const;

export const formatDates = {
    combineDateHourDescription: "PPpp" as string,
} as const;

export type CustomResponseTypeKeys = keyof typeof CustomResponseType;
