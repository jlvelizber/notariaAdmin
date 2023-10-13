import React, {
    FC,
    FormEventHandler,
    Key,
    SyntheticEvent,
    useState,
} from "react";
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
import { FormBarActions } from "@/Components/FormBarActions";
import SecondaryButton from "@/Components/SecondaryButton";
import { Inertia } from "@inertiajs/inertia";
import { useDispatch } from "react-redux";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";

export const DocRequestForm: FC<{
    sections: SectionDocFormField[] | undefined;
    customer: Customer;
    requestId: number;
    formData: any;
}> = ({ sections, customer, requestId, formData }) => {
    const dispatch = useDispatch();

    const [valuesForm, setValuesForm] = useState(formData);

    /**
     * Manda a guardar el muchacho
     * @param data
     */
    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        Inertia.put(route("requests.update", { id: requestId }), valuesForm, {
            onSuccess: () => {
                dispatch(
                    onOpenSnack({
                        message: "Solicitud Actualizada correctamente",
                        severity: "success",
                    })
                );
            },
        });
    };

    const handleChange = (e: any) => {
        const key = e.target.id;
        const value = e.target.value;
        setValuesForm((valuesForm: any) => ({
            ...valuesForm,
            [key]: value,
        }));
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
                                                    className="mt-1 block w-full 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm "
                                                    value={
                                                        valuesForm[
                                                            fieldForm.name
                                                        ]
                                                    }
                                                    onChange={handleChange}
                                                    name={fieldForm.name}
                                                    id={fieldForm.name}
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
                                                />
                                            )}
                                        </Grid>
                                    );
                                }
                            )}
                        </Grid>
                    );
                })}
                <Grid item rowSpacing={2} sx={{ paddingY: 5 }}>
                    <FormBarActions
                        saveAction={() => {}}
                        routeBack="requests.index"
                    >
                        <SecondaryButton variant="contained" color="secondary">
                            Procesar
                        </SecondaryButton>
                    </FormBarActions>
                </Grid>
            </form>
        </div>
    );
};
