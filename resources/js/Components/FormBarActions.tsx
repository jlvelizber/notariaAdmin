import React, { FC } from "react";
import {PrimaryButton} from "./Common";
import SecondaryButton from "./SecondaryButton";
import { Grid } from "@mui/material";
import { FormBarActionsInterface } from "@/types/Components.interface";
import DangerButton from "./Common/DangerButton";

export const FormBarActions: FC<FormBarActionsInterface> = ({
    saveAction,
    routeBack = "",
    deleteAction,
    children,
}) => {
    return (
        <Grid container classes={{ root: "flex justify-between" }}>
            <Grid
                item
                rowSpacing={4}
                gap={2}
                columnSpacing={2}
                justifyItems={"flex-start"}
            >
                {saveAction ? (
                    <PrimaryButton
                        type="submit"
                        onClick={saveAction}
                        variant="contained"
                    >
                        Guardar
                    </PrimaryButton>
                ) : null}

                {children}
                <SecondaryButton
                    href={
                        typeof routeBack === "string"
                            ? routeBack
                            : routeBack
                    }
                >
                    Regresar
                </SecondaryButton>
                {deleteAction ? (
                    <Grid item>
                        <DangerButton onClick={deleteAction}>
                            Borrar
                        </DangerButton>
                    </Grid>
                ) : null}
            </Grid>
        </Grid>
    );
};
