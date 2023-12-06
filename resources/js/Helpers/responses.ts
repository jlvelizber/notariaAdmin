import { AxiosResponse } from "axios";

export const downloadResponsePDF = (
    response: AxiosResponse,
    name: string = "report"
): void => {
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement("a");
    link.href = url;
    link.setAttribute("download", `${name}.pdf`);
    document.body.appendChild(link);
    link.click();
};
