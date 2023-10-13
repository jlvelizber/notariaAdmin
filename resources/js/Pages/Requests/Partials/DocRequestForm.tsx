import React, { FC, FormEventHandler, Key, useState } from "react";
import { FormDataUserApplicant } from "@/Components/FormDataUserApplicant";
import {
    Customer,
    DocFormField,
    DocFormFieldOptions,
    SectionDocFormField,
} from "@/types";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { Grid } from "@mui/material";
import { Inertia } from "@inertiajs/inertia";
import { useDispatch } from "react-redux";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { FormBarActions } from "@/Components/FormBarActions";
import SecondaryButton from "@/Components/SecondaryButton";
import { useFormRequests } from "@/Hooks/useFormRequests";

export const DocRequestForm: FC<{
    sections: SectionDocFormField[] | undefined;
    customer: Customer;
    requestId: number;
    formData: any;
    isEditable?: boolean;
}> = ({ sections, customer, requestId, formData, isEditable = true }) => {
    const dispatch = useDispatch();
    const { processForm: hookProcessForm } = useFormRequests();

    const [valuesForm, setValuesForm] = useState(formData);

    /**
     * Manda a guardar el muchacho
     * @param data
     */
    const submit: FormEventHandler = async (e) => {
        e.preventDefault();
        await Inertia.put(
            route("requests.update", { id: requestId }),
            valuesForm
        );

        // TODO: VERIFICAR QUE TODO ESTE BIEN
        dispatch(
            onOpenSnack({
                message: "Solicitud Actualizada correctamente",
                severity: "success",
            })
        );
    };

    const handleChange = (e: any) => {
        const key = e.target.id;
        const value = e.target.value;
        setValuesForm((valuesForm: any) => ({
            ...valuesForm,
            [key]: value,
        }));
    };

    const processForm = async () => {
        await hookProcessForm(requestId);
    };

    return (
        <div className="contact-form">
            {/* {errors.message && (
                <Alert show={true} variant="danger" dismissible>
                    {errors.message}
                </Alert>
            )} */}

            <form method="post" onSubmit={submit} id="request-form">
                {/* Datos de Usuarios */}
                <FormDataUserApplicant customer={customer} />

                {sections?.map((section: SectionDocFormField, unique: Key) => {
                    return (
                        <Grid
                            key={unique}
                            rowSpacing={2}
                            columnSpacing={{ xs: 1, md: 2 }}
                            container
                        >
                            {section.name && (
                                <Grid item xs={12}>
                                    <h5 className="mt-4">
                                        <strong>{section.name}</strong>
                                    </h5>
                                    <hr />
                                </Grid>
                            )}
                            {section.fields.map(
                                (fieldForm: DocFormField, key: Key) => {
                                    return (
                                        <Grid item xs={12} sm={6} key={key}>
                                            <InputLabel
                                                value={fieldForm.label}
                                                htmlFor={fieldForm.name}
                                            />
                                            {fieldForm.type === "select" ? (
                                                <select
                                                    className="mt-1 block w-full 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-gray-100 read-only:bg-gray-100"
                                                    value={
                                                        valuesForm[
                                                            fieldForm.name
                                                        ]
                                                    }
                                                    onChange={handleChange}
                                                    name={fieldForm.name}
                                                    id={fieldForm.name}
                                                    disabled={!isEditable}
                                                >
                                                    <option>Seleccione</option>
                                                    {fieldForm.options?.map(
                                                        (
                                                            option: DocFormFieldOptions,
                                                            key: Key
                                                        ) => (
                                                            <option
                                                                value={
                                                                    option.value
                                                                }
                                                                key={key}
                                                            >
                                                                {option.label}
                                                            </option>
                                                        )
                                                    )}
                                                </select>
                                            ) : (
                                                <TextInput
                                                    type={fieldForm.type}
                                                    name={fieldForm.name}
                                                    value={
                                                        valuesForm[
                                                            fieldForm.name
                                                        ]
                                                    }
                                                    className="mt-1 block w-full"
                                                    onChange={handleChange}
                                                    id={fieldForm.name}
                                                    readOnly={!isEditable}
                                                    disabled={!isEditable}
                                                />
                                            )}
                                        </Grid>
                                    );
                                }
                            )}
                        </Grid>
                    );
                })}

                {/* 
                
                    Solo si va a editar
                */}
                {isEditable && (
                    <Grid item rowSpacing={2} sx={{ paddingY: 5 }}>
                        <FormBarActions
                            routeBack="requests.index"
                            saveAction={() => {}}
                        >
                            <SecondaryButton
                                variant="contained"
                                color="secondary"
                                onClick={processForm}
                            >
                                Procesar
                            </SecondaryButton>
                        </FormBarActions>
                    </Grid>
                )}
            </form>
        </div>
    );
};
