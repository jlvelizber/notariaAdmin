import { SackAppInterface } from "@/types/Components.interface";
import { PayloadAction, createSlice } from "@reduxjs/toolkit";

const initialState: SackAppInterface = {
    message: "",
    open: false,
    severity: "info",
};

export const SnackSBarSlice = createSlice({
    name: "SnackSBarSlice",
    initialState,
    reducers: {
        onOpenSnack: (
            state,
            {
                payload,
            }: PayloadAction<{
                message: string;
                severity: SackAppInterface["severity"];
            }>
        ) => {
            state.open = true;
            state.message = payload.message;
            state.severity = payload.severity;
        },
        onCloseSnack: (state) => {
            state.message = "";
            state.severity = "info";
            state.open = false;
        },
    },
});

// Action creators are generated for each case reducer function
export const { onOpenSnack, onCloseSnack } = SnackSBarSlice.actions;
