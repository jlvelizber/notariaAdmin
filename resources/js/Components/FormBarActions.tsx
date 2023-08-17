import React from "react";
import PrimaryButton from "./PrimaryButton";
import SecondaryButton from "./SecondaryButton";
import { Grid } from "@mui/material";
import { FormBarActionsInterface } from "@/types/Components.interface";
import DangerButton from "./DangerButton";

export const FormBarActions = ({
    saveAction,
    routeBack,
    deleteAction,
}: FormBarActionsInterface) => {
    return (
        <Grid container classes={{ root: "flex justify-between" }}>
            <Grid item>
                {saveAction ? (
                    <PrimaryButton
                        type="submit"
                        onClick={saveAction}
                        variant="contained"
                    >
                        Guardar
                    </PrimaryButton>
                ) : null}

                <SecondaryButton href={route(routeBack)}>
                    Regresar
                </SecondaryButton>
            </Grid>
            {deleteAction ? <Grid item><DangerButton onClick={deleteAction}>Borrar</DangerButton></Grid> : null}
        </Grid>
    );
};
