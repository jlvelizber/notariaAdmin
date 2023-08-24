import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import React, { useEffect } from "react";
import { useDispatch } from "react-redux";

export default function ErrorPage({ status }: string) {
    const title: any = {
        503: "503: Service Unavailable",
        500: "500: Server Error",
        404: "404: Page Not Found",
        403: "403: Forbidden",
    }[status];

    const description: any = {
        503: "Sorry, we are doing some maintenance. Please check back soon.",
        500: "Whoops, something went wrong on our servers.",
        404: "Sorry, the page you are looking for could not be found.",
        403: "Sorry, you are forbidden from accessing this page.",
    }[status];

    const dispatch = useDispatch();
    useEffect(() => {
        dispatch(
            onOpenSnack({
                message: status,
                severity: "error",
            })
        );
    }, [status]);

    return (
        <div>
            <h1>{title}</h1>
            <div>{description}</div>
        </div>
    );
}
