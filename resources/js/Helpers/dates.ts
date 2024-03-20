import { formatDates } from "@/Contants";
import { format } from "date-fns";
import { es, enUS } from "date-fns/locale";

const localeApp = import.meta.env.VITE_APP_LOCALE;

export const humanizeDate = (date: string, formatDate: string = "") => {
    const parsedDate: Date = new Date(date);

    const formatShow: string = formatDate
        ? formatDate
        : formatDates.combineDateHourDescription;

    return format(parsedDate, formatShow, {
        locale: localeApp ? es : enUS,
    });
};
