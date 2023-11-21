import Snackbar from "@mui/material/Snackbar";
import { useDispatch, useSelector } from "react-redux";
import { RootState } from "@/store";
import { onCloseSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { Alert } from "@mui/material";

export default function SnackApp() {
    const { open, message, severity } = useSelector(
        (state: RootState) => state.SnackSBarSlice
    );
    const dispatch = useDispatch();

    const handleClose = () => {
        dispatch(onCloseSnack());
    };

    return (
        <Snackbar
            anchorOrigin={{ horizontal: "right", vertical: "top" }}
            autoHideDuration={3000}
            open={open}
            onClose={handleClose}
        >
            <Alert
                onClose={handleClose}
                severity={severity}
                sx={{ width: "100%" }}
            >
                {message}
            </Alert>
        </Snackbar>
    );
}
