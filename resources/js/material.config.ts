import { createTheme } from "@mui/material";
import type {} from "@mui/x-data-grid/themeAugmentation";
import { esES } from "@mui/material/locale";
import { esES as esDataGrid } from "@mui/x-data-grid";

const MUItheme = createTheme(
    {
        components: {
            MuiSelect: {
                styleOverrides: {
                    outlined: {
                        padding: 11,
                    },
                },
            },
            MuiDataGrid: {
                defaultProps: {
                    checkboxSelection: false,
                    localeText: {
                        noResultsOverlayLabel: "Sin resultados",
                        noRowsLabel: "Sin resultados",
                    },
                },
            },
        },
    },
    esDataGrid,
    esES,
);

export default MUItheme;
