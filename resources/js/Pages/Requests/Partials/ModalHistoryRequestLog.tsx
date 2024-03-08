/* eslint-disable @typescript-eslint/no-explicit-any */
import { FC, ReactNode, useEffect, useState } from "react";
import { Modal } from "@/Components/Common";
import { HistoryModalProps } from "@/types/Components.interface";
import { useFormRequests } from "@/Hooks/useFormRequests";
import { HistoryLogInterface } from "@/types";
import { HistoryLogDataTable } from ".";

export const ModalHistoryRequestLog: FC<HistoryModalProps> = ({
    isOpen,
    requestId,
    onClose,
}): ReactNode => {
    const { loadHistory } = useFormRequests();
    const [history, setHistory] = useState<HistoryLogInterface[]>();

    const getHistory = async () => {
        const data = await loadHistory(requestId);
        setHistory(data as unknown as HistoryLogInterface[]);
    };

    useEffect(() => {
        if (requestId > 0) {
            getHistory();
        }

        return () => {
            setHistory([]);
        };
    }, [requestId]);

    return history?.length ? (
        <Modal
            open={isOpen}
            onClose={onClose}
            size="large"
            autoClose={false}
            closable
            disablePortal
        >
            <HistoryLogDataTable rows={history} />
        </Modal>
    ) : null;
};
