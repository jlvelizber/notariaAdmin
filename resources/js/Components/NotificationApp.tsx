import React from 'react'
import Snackbar, { SnackbarOrigin } from '@mui/material/Snackbar';

export default function NotificationApp() {
  return (
    <Snackbar
        anchorOrigin={{ vertical, horizontal }}
        open={open}
        onClose={handleClose}
        message="I love snacks"
        key={vertical + horizontal}
      />
  )
}
