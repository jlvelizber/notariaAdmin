import React  from "react";

export default function ModalContentDeleteRole() {
    return (
        <Dialog open={isOpen} onClose={onClose}>
          <DialogTitle>Delete {resourceName}</DialogTitle>
          <DialogContent>
            <div className="flex items-center space-x-2">
              <TrashIcon className="w-6 h-6 text-red-500" />
              <p>Are you sure you want to delete {resourceName}?</p>
            </div>
          </DialogContent>
          <DialogActions>
            <Button onClick={onClose} color="primary">
              Cancel
            </Button>
            <Button onClick={onDelete} color="error">
              Delete
            </Button>
          </DialogActions>
        </Dialog>
      );
}
