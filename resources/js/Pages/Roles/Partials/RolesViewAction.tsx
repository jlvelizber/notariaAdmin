import React from "react";
import PrimaryButton from "@/Components/PrimaryButton";

export const RolesViewAction = () => {
    return (
        <div className="flex flex-col md:flex-row space-x-2">
            
                <PrimaryButton
                    className="w-full text-center h-10 !my-5 !p-6"
                    variant="contained"
                    href={route("roles.new")}
                >
                    Nuevo Rol
                </PrimaryButton>
           
                <PrimaryButton
                    className="w-full text-center h-10 !my-5 !p-6"
                    variant="contained"
                    href={route("roles.new")}
                >
                    Nuevo Rol
                </PrimaryButton>
            
        </div>
    );
};
