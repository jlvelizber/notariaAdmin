import React, { FC } from "react";
import { Customer } from "@/types";
import { Grid } from "@mui/material";
import InputLabel from "./Common/InputLabel";
import TextInput from "./Common/TextInput";

export const FormDataUserApplicant: FC<{ customer: Customer }> = ({
    customer,
}) => {
    return (
        <>
            <h5>
                <strong>Datos del Solicitante</strong>
            </h5>
            <hr />
            <Grid
                container
                rowSpacing={2}
                spacing={2}
                columnSpacing={{ xs: 1, md: 2 }}
            >
                <Grid item xs={12} sm={6}>
                    <InputLabel htmlFor="name" value="Nombre" />

                    <TextInput
                        name="name"
                        value={`${customer.name}  ${customer.midle_name}`}
                        disabled={true}
                        className="mt-1 block w-full disabled:bg-gray-100"
                        readOnly
                    />
                </Grid>
                <Grid item xs={12} sm={6}>
                    <InputLabel htmlFor="lastname" value="Apellidos" />
                    <TextInput
                        name="lastname"
                        value={`${customer.first_last_name}  ${customer.second_last_name}`}
                        disabled={true}
                        className="mt-1 block w-full disabled:bg-gray-100"
                        readOnly
                    />
                </Grid>
            </Grid>
            <Grid
                container
                rowSpacing={2}
                spacing={2}
                columnSpacing={{ xs: 1, md: 2 }}
            >
                <Grid item xs={12} sm={6}>
                    <InputLabel htmlFor="name" value="Nacionalidad" />
                    <TextInput
                        name="lastname"
                        value={`${
                            customer.country_id ? customer.country_id : ""
                        }`}
                        disabled={true}
                        className="mt-1 block w-full disabled:bg-gray-100"
                    />
                </Grid>
                <Grid item xs={12} sm={6}>
                    <InputLabel htmlFor="name" value="Identificación" />
                    <TextInput
                        name="identification_num"
                        value={`${
                            customer.identification_num
                                ? customer.identification_num
                                : ""
                        } `}
                        disabled={true}
                        className="mt-1 block w-full disabled:bg-gray-100"
                        readOnly
                    />
                </Grid>
            </Grid>
        </>
    );
};
