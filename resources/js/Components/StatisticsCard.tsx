import React from "react";
import { Card, CardContent, Typography } from "@mui/material";

interface StatisticsCardProps {
    title: string;
    value: number;
}

export default function StatisticsCard({ title, value }: StatisticsCardProps) {
    return (
        <Card className="w-64 bg-white shadow-md rounded-md p-4">
            <CardContent>
                <Typography variant="h6" gutterBottom>
                    {title}
                </Typography>
                <Typography variant="h4">{value}</Typography>
            </CardContent>
        </Card>
    );
}
