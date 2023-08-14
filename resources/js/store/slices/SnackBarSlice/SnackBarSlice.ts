import { createSlice } from "@reduxjs/toolkit";
import { SnackBarSliceInterface } from "./SnackBarSlice.interface";

const initialState: SnackBarSliceInterface = {
    message: "",
    type: "",
};

export const SnackSBarSlice = createSlice({
    name: "SnackSBarSlice",
    initialState,
    reducers: {
       
    },
});

// Action creators are generated for each case reducer function
export const { } = SnackSBarSlice.actions;