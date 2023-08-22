import { createTheme } from "@mui/material";

const MUItheme = createTheme({
    components: {
        MuiSelect: {
            styleOverrides: {
                outlined: {
                    padding: 11,
                },
            },
        },
    },
});

export default MUItheme;
