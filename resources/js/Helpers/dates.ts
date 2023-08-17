import { parseISO, formatDistance } from "date-fns";
import { es, enUS } from "date-fns/locale";
const localeApp = import.meta.env.VITE_APP_LOCALE;

export const humanizeDate = (date: string) => {
    const parsedDate: Date = parseISO(date);
    const nowDate: Date = new Date();

    return formatDistance(parsedDate, nowDate, {
        locale: localeApp ? es : enUS,
        addSuffix: true,
    });
};
